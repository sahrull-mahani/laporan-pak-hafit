<?php

function replaceBulan($date)
{
    if (str_contains($date, 'Jan')) {
        return str_replace('Jan', 'Januari', $date);
    } elseif (str_contains($date, 'Feb')) {
        return str_replace('Feb', 'Februari', $date);
    } elseif (str_contains($date, 'Mar')) {
        return str_replace('Mar', 'Maret', $date);
    } elseif (str_contains($date, 'Apr')) {
        return str_replace('Apr', 'April', $date);
    } elseif (str_contains($date, 'May')) {
        return str_replace('May', 'Mei', $date);
    } elseif (str_contains($date, 'Jun')) {
        return str_replace('Jun', 'Juni', $date);
    } elseif (str_contains($date, 'Jul')) {
        return str_replace('Jul', 'Juni', $date);
    } elseif (str_contains($date, 'Aug')) {
        return str_replace('Aug', 'Agustus', $date);
    } elseif (str_contains($date, 'Sep')) {
        return str_replace('Sep', 'September', $date);
    } elseif (str_contains($date, 'Oct')) {
        return str_replace('Oct', 'Oktober', $date);
    } elseif (str_contains($date, 'Nov')) {
        return str_replace('Nov', 'November', $date);
    } elseif (str_contains($date, 'Dec')) {
        return str_replace('Dec', 'Desember', $date);
    } else {
        return 'Unknown {pastikan format date yang anda masukan M}';
    }
}

function hari($hari)
{
    switch ($hari) {
        case 'Sun':
            $hari_ini = 'Minggu';
            break;

        case 'Mon':
            $hari_ini = 'Senin';
            break;

        case 'Tue':
            $hari_ini = 'Selasa';
            break;

        case 'Wed':
            $hari_ini = 'Rabu';
            break;

        case 'Thu':
            $hari_ini = 'Kamis';
            break;

        case 'Fri':
            $hari_ini = 'Jumat';
            break;

        case 'Sat':
            $hari_ini = 'Sabtu';
            break;

        default:
            $hari_ini = 'Tidak di ketahui {D}';
            break;
    }

    return $hari_ini;
}

function tanggalFormat($date)
{
    $timestamp = new DateTime($date);
    $timestamp = $timestamp->getTimestamp();

    $hari = hari(date('D', $timestamp));
    $bulan = replaceBulan(date('M', $timestamp));
    $tahun = date('Y', $timestamp);

    $day = date('d', $timestamp);

    return "$hari, $day $bulan $tahun";
}