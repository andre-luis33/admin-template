<?php

function title($icon, $title, $subtitle = '') {
   echo "
   <div class='page-title'>
      <div class='icon'>
         <i class='{$icon}'></i>
      </div>
      <div class='text'>
         <h2>{$title}</h2>
         <p>{$subtitle}</p>
      </div>
   </div>
   ";
}

function widget($number, $legend, $icon, $color, $href) {
   echo "
   <div class='widget {$color}'>
      <div class='box'>
         <div class='text'>
            <h3> {$number} </h3>
            <p>{$legend}</p>
         </div>   
         <div class='icon'>
            <i class='{$icon}'></i>
         </div>
      </div>
      <footer>
         <a href='{$href}'>
            Veja mais
         </a>
      </footer>
   </div>
   ";
}



?>