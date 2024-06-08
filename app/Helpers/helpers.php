
<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        return 'Rp' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('formatTanggal')) {
    function formatTanggal($date)
    {
        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('formatTanggalperiode')) {
    function formatTanggalperiode($date)
    {
        return \Carbon\Carbon::parse($date)->format('M/Y');
    }
}

