<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Livewire::setUploadsTemporaryDisk('local'); // Use 'local' disk for temporary uploads
        config()->set('livewire.temporary_file_upload.disk', 'local');
        config()->set('livewire.temporary_file_upload.rules', 'file|max:102400'); // 100MB
        config()->set('livewire.temporary_file_upload.max_upload_time', 5 * 60); // 5 minutes
    }
}
