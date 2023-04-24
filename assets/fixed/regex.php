<?php 

$reName = '/^[A-ZĐŽŠČĆ][a-zđžščć]{2,20}$/'; //at least 3 characters and first letter upper and max 20 characters with Serbian alphabet

$reNameSurname = '/^([A-ZĐŽŠČĆ][a-zđžščć]{2,20})(\s[A-ZĐŽŠČĆ][a-zđžščć]{2,20})*$/';

$reEmail = '/^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?\.[a-z]{2,3}$/';

$rePassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d@$!%*?&.]{8,}$/';

$reAddress = '/^[A-Z][a-z]*[\s\w]+$/';

$reNumber = '/^[0-9]{7,11}$/';

$reText = '/^[A-z][\w\s\.,?!]*$/';

$reTime = '/^(0[8-9]|1[0-9]|20):[0-5][0-9]$/';

?>