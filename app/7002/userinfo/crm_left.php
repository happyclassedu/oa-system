    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">客户管理</li>
          <li class="leftmenuli_2"><a href="client_add.php" target="_self">增加客户</a></li>
          <li class="leftmenuli_2"><a href="client_manage.php" target="_self">管理客户</a></li>
          <li class="leftmenuli_2"><a href="client_manage_pub.php" target="_self">公共客户区</a></li>
          <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='client_manage_ceo.php' target='_self'>领导查询客户</a></li>";?>
            
    			<li class="leftmenuli">联系人管理</li>
          <li class="leftmenuli_2"><a href="linkman_add.php" target="_self">新建联系人</a></li> 
          <li class="leftmenuli_2"><a href="linkman_manage.php" target="_self">管理联系人</a></li> 
          <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='linkman_manage_ceo.php' target='_self'>领导查询联系人</a></li>";?>
                   		
    		</ul>
    	</div> 