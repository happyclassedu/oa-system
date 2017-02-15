    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">销售商机分析</li>
          <li class="leftmenuli_2"><a href="meddic_add.php" target="_self">新建分析</a></li>
          <li class="leftmenuli_2"><a href="meddic_manage.php" target="_self">管理分析</a></li>
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='meddic_manage_ceo.php' target='_self' title='领导浏览所有销售分析数据'>领导浏览分析</a></li>";?>
          
		
    		</ul>
    	</div> 