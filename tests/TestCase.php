<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Chặn tuyệt đối việc chạy test trên database thật (MySQL) để không bao giờ bị mất dữ liệu.
     */
    protected function setUpTraits(): array
    {
        if (file_exists(base_path('bootstrap/cache/config.php'))) {
            throw new RuntimeException(
                'Đã chặn chạy test để bảo vệ dữ liệu MySQL: phát hiện file bootstrap/cache/config.php. Hãy chạy `php artisan config:clear` trước khi chạy test.'
            );
        }

        if (
            config('database.default') !== 'sqlite'
            || config('database.connections.sqlite.database') !== ':memory:'
        ) {
            throw new RuntimeException(
                'Đã chặn chạy test để bảo vệ dữ liệu: test chỉ được phép chạy trên sqlite (:memory:), hiện tại đang là '.config('database.default').'.'
            );
        }

        return parent::setUpTraits();
    }
}
