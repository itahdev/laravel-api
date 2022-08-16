<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\UploadFileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UploadFileController extends Controller
{
    /**
     * @var UploadFileService
     */
    public UploadFileService $uploadFileService;

    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('tests.upload.index');
    }

    /**
     * @param UploadFileRequest $request
     * @return RedirectResponse
     */
    public function store(UploadFileRequest $request): RedirectResponse
    {
        $path = $this->uploadFileService->upload($request);

        return redirect()->back()->with('path', $path);
    }
}
