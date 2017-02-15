    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">商机管理</li>
          <li class="leftmenuli_2"><a href="chance_add.php" target="_self">新建商机</a></li>
          <li class="leftmenuli_2"><a href="chance_manage.php" target="_self">管理商机</a></li>
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='chance_manage_ceo.php' target='_self'>领导查询商机</a></li>";?>
    		</ul>
    	</div> 