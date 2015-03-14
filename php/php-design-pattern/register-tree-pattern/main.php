<?php
require_once __DIR__ . '/autoload.php';
$splstack = new SplStack();
$splstack->push('222');
$splstack->push('333');
$splstack->push('555');
$splstack->push('666');

$spl_fixed_array = new splFixedArray(3);
$spl_fixed_array['2'] = 33;

#$register = new Register();
Register::set('splstack', $splstack);   #注册对象
Register::set('splarray', $spl_fixed_array);

$splarray = Register::get('splarray');  #获得对象
print_r($splarray);
