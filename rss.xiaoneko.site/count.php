<?php
if($row['provience']=="北京市")
{
    if($row['atschool']=="在校")
    {
    $count_atschool=$count_atschool+1;
    if($row['background']=="本科")
    {
        $at_school_ben=$at_school_ben+1;
    }elseif($row['background']=="硕士")
    {
        $at_school_shuo=$at_school_shuo+1;
    }elseif($row['background']=="博士")
    {
        $at_school_bo=$at_school_bo+1;
    }
    if($row['vaccine']=="1")
    {
        $at_school_vaccine=$at_school_vaccine+1;
    }
    }else
    {
        $count_beijing=$count_beijing+1;
        if($row['vaccine']=="1")
        {
            $beijing_vaccine=$beijing_vaccine+1;
        }
    }
}

if($row['provience']!="港澳台"&&$row['provience']!="国外"&&$row['provience']!="北京市")
{
    if($row['vaccine']=="1")
    {
        $other_vaccine=$other_vaccine+1;
    }
}

if($row['provience']=="港澳台")
{
    $count_border=$count_border+1;
}

if($row['provience']=="国外")
{
    $count_foreign=$count_foreign+1;
}

$count_all=$count_all+1;

?>

