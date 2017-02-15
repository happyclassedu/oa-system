    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">日程管理</li>
          <li class="leftmenuli_2"><a href="calendar_add.php" target="_self">新建日程</a></li>
          <li class="leftmenuli_2"><a href="calendar_manage.php" target="_self">管理日程</a></li>
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='calendar_manage_ceo.php' target='_self' title='查询所有日程'>领导查询日程</a></li>";?>
          
		
    		</ul>
    	</div> 