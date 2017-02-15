    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">市场活动管理</li>
          <li class="leftmenuli_2"><a href="market_add.php" target="_self">新建市场活动</a></li> 
          <li class="leftmenuli_2"><a href="market_manage.php" target="_self">管理市场活动</a></li> 	
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='market_manage_ceo.php' target='_self'>领导查询市场</a></li>";?>
              	
    		</ul>
    	</div> 