<?php 
class Cms5e9377c685292067917710_d57e750d884196b57fd5365aacd1bc40Class extends Cms\Classes\PageCode
{
public function onStart()
{
$this['vuetober'] = [
'env' => app()->env,
'token' => Session::token(),
];
}
}
