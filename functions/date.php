<?php
function date_ind($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $destroy = explode('-', $tanggal);

    return $destroy[2] . ' ' . $bulan[(int)$destroy[1]] . ' ' . $destroy[0];
}
