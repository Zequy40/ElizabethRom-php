
<div class="contain">
    <div class="container">
        <div class="logo"><a href="/"><img src="src/assets/logoFinal.svg" alt="LOGO" ></a></div>
        <div class="title"><p>Elizabeth Rom</p><p class="p">Brand</p></div>
        <?php if (!isset($user_id) || empty($user_id)) { ?>
            <a href="search.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke-width="2" class="svg" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 -1.74846e-07C6.20914 -2.7141e-07 8 1.79086 8 4C8 6.20914 6.20914 8 4 8C1.79086 8 -7.8281e-08 6.20914 -1.74846e-07 4C-2.7141e-07 1.79086 1.79086 -7.8281e-08 4 -1.74846e-07ZM7 4C7 2.34315 5.65685 1 4 1C2.34315 1 1 2.34315 1 4C1 5.65685 2.34315 7 4 7C5.65685 7 7 5.65685 7 4Z" fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M8.38889 9.09616L6.12108 6.82837L6.82819 6.12126L9.09601 8.38904C9.29128 8.58431 9.29127 8.90089 9.09601 9.09616C8.90074 9.29142 8.58416 9.29143 8.38889 9.09616Z" fill="currentColor"></path></svg></a> <?php 
            } 
        ?>
        <button id="addToCart"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg"><rect x="2.5" y="1.5" width="19" height="21" fill="none" stroke="black"></rect><path d="M17 4C17 6.76142 14.7614 9 12 9C9.23858 9 7 6.76142 7 4H8C8 6.20914 9.79086 8 12 8C14.2091 8 16 6.20914 16 4H17Z" fill="black" class=""></path></svg></button>
   
</div>
</div>