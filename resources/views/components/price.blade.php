@props(['value' => 0, 'free' => false, 'suffix' => '₫', 'zero' => 'Miễn phí'])
{{ $free ? 'Miễn phí' : ((float) $value <= 0 ? $zero : number_format((float) $value, 0, ',', '.').' '.$suffix) }}
