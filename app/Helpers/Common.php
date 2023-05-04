<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class Common
{
	private static $crypt_number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
	private static $crypt_hash = [
		"hdSZxmPf", // 0
		"ORYKtkau", // 1
		"YlyUrXFf", // 2
		"geJhkfEy", // 3
		"EuosKGjk", // 4
		"UVICPjbf", // 5
		"aZXqRKJg", // 6
		"lTtGUZwM", // 7
		"RYAxNZtM", // 8
		"skILXxgK", // 9
	];

	public static function encrypt($val)
	{
		$encrypt = str_replace(self::$crypt_number, self::$crypt_hash, $val);
		return $encrypt;
	}

	public static function decrypt($val)
	{
		$decrypt = str_replace(self::$crypt_hash, self::$crypt_number, $val);
		return ($decrypt == $val) ? null : $decrypt;
	}

	public static function dateFormat($date, $format = 'dd mmmm yyyy')
	{
		$time = strtotime($date);
		$day = date('d', $time);
		$dayName = self::dayFormat(date('N', $time));
		$mmmm = self::monthFormat(date('n', $time));
		$mmm = self::monthFormat(date('n', $time), 'mmm');
		$mm = date('m', $time);
		$yyyy = date('Y', $time);
		$yy = date('y', $time);
		$hh = date('H', $time);
		$h = date('h', $time);
		$ii = date('i', $time);

		$search = ['day', 'dd', 'mmmm', 'mmm', 'mm', 'yyyy', 'yy', 'hh', 'h', 'ii'];
		$replace = [$dayName, $day, $mmmm, $mmm, $mm, $yyyy, $yy, $hh, $h, $ii];

		return str_replace($search, $replace, $format);
	}

    public static function monthFormat($month, $format = 'mmmm') // date('n')
    {
		if ($format == 'mmmm') {
			$fm = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		} elseif ($format == 'mmm') {
			$fm = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
		} elseif ($format == 'romawi') {
			$fm = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
		}

		return $fm[$month-1];
	}

	public static function dayFormat($day, $format = 'dddd') // date('N')
    {
		if ($format == 'dddd') {
			$fd = ['Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu'];
		} elseif ($format == 'ddd') {
			$fd = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
		}

		return $fd[$day-1];
	}

	public static function option($request)
	{
		$opt = [
			'role' => [
				'admin' => 'Admin',
				'operator' => 'Operator'
			],
			'gender' => [
				'1' => 'Laki-laki',
				'2' => 'Perempuan'
			],
			'student_status' => [
				'1' => 'Lulus',
				'0' => 'Tidak Lulus'
			],
			'app_status' => [
				'1' => 'Online',
				'0' => 'Offline'
			]
		];

		return $opt[$request];
	}

	public static function phoneFormat($phone)
	{
		$length = strlen($phone);
		$phone1 = substr($phone, 0, 4);
		$phone2 = substr($phone, 4, 4);
		$phone3 = substr($phone, 8, 4);
		$phone4 = ($length > 12) ? '-' . substr($phone, 12, $length-12) : '';

		return $phone1 . '-' . $phone2 . '-' . $phone3 . $phone4;
	}

	public static function phoneCorrection($phone)
	{
		$phone = str_replace(' ', '', $phone);
		$phone_code = substr($phone, 0, 2);
		$phone_code_plus = substr($phone, 0, 3);

		if ($phone_code == '62')
			$phone = '0' . substr($phone, 2, strlen($phone));
		else if ($phone_code_plus == '+62')
			$phone = '0' . substr($phone, 3, strlen($phone));

		return $phone;
	}

	public static function rounding($amount)
	{
		$hundreds = substr($amount, strlen($amount) - 3, 1) + 1;
		$round = substr($amount, 0, strlen($amount) - 3) . $hundreds . '00';

		return $round;
	}

	public static function randomString($len = 8)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
	}

	public static function optionList($model, $value_field, $label_field)
	{
		$option = [];

		foreach ($model as $m)
			$option[$m->{$value_field}] = $m->{$label_field};

		return $option;
	}

	public static function capitalize($string){
		$capital = Str::title($string);

		return $capital;
	}

	public static function toRp($string): string
	{
		return 'Rp. ' . number_format($string, 0,"",".");
	}
}
