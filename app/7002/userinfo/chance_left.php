    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<li class="leftmenuli">�̻�����</li>
          <li class="leftmenuli_2"><a href="chance_add.php" target="_self">�½��̻�</a></li>
          <li class="leftmenuli_2"><a href="chance_manage.php" target="_self">�����̻�</a></li>
      <? if (checkuserceo(trim($_SESSION["isfuze"]))) echo "<li class='leftmenuli_2'><a href='chance_manage_ceo.php' target='_self'>�쵼��ѯ�̻�</a></li>";?>
    		</ul>
    	</div> 