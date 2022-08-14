<?php

namespace Modules\Partner\Services\Socials;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;

class Line extends AbstractProvider implements ProviderInterface
{
    /**
     * @inheritDoc
     */
    protected $scopes = [
        'openid',
        'profile',
        'email'
    ];

    /**
     * @inheritDoc
     */
    protected $scopeSeparator = ' ';

    /**
     * @inheritDoc
     */
    protected $encodingType = PHP_QUERY_RFC3986;

    /**
     * @inheritDoc
     *
     * @param string $state
     * @return string
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.line.auth_url'), $state);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    protected function getTokenUrl(): string
    {
        return config('services.line.token_url');
    }

    /**
     * Redirect the user of the application to the provider's authentication screen.
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        $state = $this->getState();

        return new RedirectResponse($this->getAuthUrl($state));
    }

    /**
     * Get the GET parameters for the code request.
     *
     * @param  string|null  $state
     * @return array
     */
    protected function getCodeFields($state = null): array
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
            'response_type' => 'code',
            'state' => $state,
        ];

        return array_merge($fields, $this->parameters);
    }

    /**
     * @inheritDoc
     *
     * @param string $code
     * @return array
     */
    protected function getTokenFields($code): array
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    /**
     * @inheritDoc
     *
     * @param string $token
     * @return array
     * @throws GuzzleException
     */
    protected function getUserByToken($token): array
    {
        $response = $this->getHttpClient()->post(
            config('services.line.verify_url'), [
            'form_params' => [
                'id_token' => $token,
                'client_id' => $this->clientId,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     *
     * @param array $user
     * @return User
     */
    protected function mapUserToObject(array $user): User
    {
        return (new User())->setRaw($user)->map([
            'id' => data_get($user, 'sub'),
            'nickname' => null,
            'name' => data_get($user, 'name'),
            'avatar' => data_get($user, 'picture'),
            'email' => data_get($user, 'email'),
        ]);
    }

    /**
     * @inheritDoc
     *
     * @return User|null
     * @throws GuzzleException
     */
    public function user(): User|null
    {
        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());
        $token = Arr::get($response, 'access_token');
        $idToken = Arr::get($response, 'id_token');
dd($response);
        $userByToken = $this->getUserByToken($idToken);
        $user = $this->mapUserToObject($userByToken);

        return $user->setToken($token)
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'));
    }
}
