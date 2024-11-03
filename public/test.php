<?php
function student($name, $age){
    echo "My name is {$name} and I'm {$age} years old";
}

call_user_func_array('student', ["Gbenga", "8"]);
