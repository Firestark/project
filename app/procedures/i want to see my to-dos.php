<?php

when('i want to see my to-dos', then(apply(a( 
    
function (Todo\Manager $manager)
{
    return [1001, ['todos' => $manager->all()]];
}))));