    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">�ճ̹���</li>
          <li class="leftmenuli_2"><a href="calendar_add.php" target="_self">�½��ճ�</a></li>
          <li class="leftmenuli_2"><a href="calendar_manage.php" target="_self">�����ճ�</a></li>
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='calendar_manage_ceo.php' target='_self' title='��ѯ�����ճ�'>�쵼��ѯ�ճ�</a></li>";?>
          
		
    		</ul>
    	</div> 