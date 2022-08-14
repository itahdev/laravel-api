<?php

namespace Modules\Partner\Services\Socials;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;

class Yahoo extends AbstractProvider implements ProviderInterface
{
    /**
     * @inheritDoc
     */
    protected $scopes = [
        'openid',
        'profile',
        'email',
    ];

    /**
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * @var string
     */
    private string $accessToken;

    /**
     * Set the access token on the userinfo api.
     *
     * @param string $accessToken
     * @return self
     */
    private function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get the access token on the userinfo api.
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @inheritDoc
     *
     * @param string $state
     * @return string
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.yahoo.auth_url'), $state);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    protected function getTokenUrl(): string
    {
        return config('services.yahoo.token_url');
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
        dd($response);
        $token = Arr::get($response, 'access_token');
        $idToken = Arr::get($response, 'id_token');

        $userByToken = $this->setAccessToken($token)->getUserByToken($idToken);
        $user = $this->mapUserToObject($userByToken);

        return $user->setToken($token)
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'));
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
        $response = $this->getHttpClient()->get(
            config('services.yahoo.userinfo'), [
            'query' => [
                'id_token' => $token,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code): array
    {
        $fields = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->redirectUrl,
            'code_verifier' => $this->request->get('code_verifier'),
        ];

        $codeVerifier = $this->request->get('code_verifier');
        if ($codeVerifier) {
            $fields['code_verifier'] = $codeVerifier;
        }

        return $fields;
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
            'nickname' => data_get($user, 'nickname'),
            'name' => data_get($user, 'name'),
            'avatar' => data_get($user, 'picture'),
            'email' => data_get($user, 'email'),
        ]);
    }
}
