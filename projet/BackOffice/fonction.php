<?php 

/*
Fonction permettant de rediriger vers une autre page
 */
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}
?>
