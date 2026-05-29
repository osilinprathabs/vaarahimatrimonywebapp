<?php

if (!function_exists('storage_url')) {
    /**
     * Get the URL to a stored file that works both locally (via symlink)
     * and on shared hosting (via the storage route workaround).
     *
     * @param string $path  e.g. "uploads/profile/abc.jpg"
     * @return string
     */
    function storage_url(string $path): string
    {
        $path = ltrim($path, '/');

        // If the public/storage symlink exists and is a real symlink, use asset()
        $symlinkPath = public_path('storage');
        if (is_link($symlinkPath) && is_dir($symlinkPath)) {
            return asset('storage/' . $path);
        }

        // Fallback: use the storage route workaround (shared hosting)
        return url('storage/' . $path);
    }
}
