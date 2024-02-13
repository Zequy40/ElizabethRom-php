<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<nav class="footer_footer">
  
    <a href="/"><div class="footer_containDiv <?php if ($currentPage == 'index.php') { echo 'actived'; } ?>">
        <div class="footer_icon <?php if ($currentPage == 'index.php') { echo 'linked'; } ?>"><svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="footer_svg " viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
        </svg></div>
        <div class="footer_p ">Inicio</div>
    </div></a>
    <a href="account.php"><div class="footer_containDiv <?php if ($currentPage == 'account.php') { echo 'actived'; } ?>">
        <div class="footer_icon <?php if ($currentPage == 'account.php') { echo 'linked'; } ?>"><svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="footer_svg"><circle cx="12" cy="7" r="4.5" stroke="#fff" fill="transparent"></circle><path d="m2.5145 22.5c0.25881-4.4617 3.959-8 8.4855-8h2c4.5266 0 8.2267 3.5383 8.4855 8h-18.971z" stroke="#fff" fill="transparent"></path></svg></div>
        <div class="footer_p">Cuenta</div>
    </div>
    </a>
    <div class="footer_containDiv" id="menu">
        <div class="footer_iconMenu <?php if ($currentPage == 'index.php') { echo 'linked'; } ?>" id="icon"><svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="footer_svg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
          </svg></div>
        <div class="footer_p" >Menu</div>
    </div>
    <a href="shop.php"><div class="footer_containDiv <?php if ($currentPage == 'shop.php') { echo 'actived'; } ?>">
        <div class="footer_icon <?php if ($currentPage == 'shop.php') { echo 'linked'; } ?>"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="footer_svg" viewBox="0 0 16 16">
            <path d="M3 0h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm0 8h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/></div>
        <div class="footer_p">Comprar</div>
    </div></a>
    <a href="whislist.php"><div class="footer_containDiv <?php if ($currentPage == 'whislist.php') { echo 'actived'; } ?>">
        <div class="footer_icon <?php if ($currentPage == 'whislist.php') { echo 'linked'; } ?>"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="footer_svg"><path d="m11.442 22.83 0.5576-0.8302 0.5574 0.8303c-0.3372 0.2264-0.7778 0.2263-1.115-1e-4zm-8.4909-18.565c-1.926 1.658-2.3462 4.2841-1.6118 6.7691 1.4723 4.7949 10.66 10.965 10.66 10.965-0.5576 0.8302-0.5576 0.8302-0.5576 0.8302l-0.0085-0.0058-0.0217-0.0146-0.0811-0.0553c-0.0704-0.0483-0.1727-0.1189-0.3027-0.2101-0.2601-0.1822-0.6316-0.4469-1.0813-0.7791-0.89834-0.6638-2.1138-1.601-3.3786-2.693-1.2622-1.0897-2.5896-2.3473-3.7028-3.6526-1.1004-1.2903-2.0542-2.6989-2.4818-4.0916l-0.003098-0.01c-0.81054-2.7426-0.38937-5.8203 1.9139-7.8066 1.7637-1.5518 4.5433-1.9758 6.7159-0.95786 0.37337 0.15877 0.78652 0.42089 1.1605 0.6826 0.3962 0.27718 0.8062 0.5953 1.1719 0.89135 0.2399 0.19413 0.4641 0.38158 0.6572 0.54591 0.1931-0.16413 0.4172-0.35135 0.6568-0.54523 0.3657-0.29582 0.7757-0.61369 1.1718-0.89068 0.3741-0.26155 0.7871-0.52346 1.1603-0.68216 2.1726-1.0179 4.9522-0.59388 6.7159 0.95786 2.3034 1.9863 2.7247 5.064 1.9142 7.8065l-3e-3 0.0101c-0.4275 1.3927-1.3814 2.8013-2.4818 4.0914-1.1133 1.3051-2.4407 2.5625-3.7029 3.652-1.2649 1.0918-2.4804 2.0288-3.3788 2.6923-0.4497 0.3322-0.8212 0.5968-1.0812 0.779-0.1301 0.0911-0.2324 0.1617-0.3028 0.21l-0.0811 0.0553-0.0217 0.0146-0.0059 4e-3 -0.0018 0.0012s-8e-4 6e-4 -0.5582-0.8297c0 0 9.1882-6.1687 10.66-10.964 0.7344-2.485 0.3141-5.1111-1.612-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3966-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" clip-rule="evenodd" fill-rule="evenodd"></path><path d="m2.9516 4.2654c-1.926 1.658-2.3462 4.2841-1.6118 6.7692 1.4723 4.7948 10.66 10.965 10.66 10.965s9.1882-6.1687 10.66-10.964c0.7343-2.4851 0.314-5.1112-1.6121-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3965-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" fill="transparent" class="footer_"></path></svg></div>
        <div class="footer_p">Favoritos</div>
    </div></a>
</nav>