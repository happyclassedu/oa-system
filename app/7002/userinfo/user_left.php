    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<?
    			if (trim($_SESSION["userdlname"])=="admin")
    			{
    			?> 
    			<li class="leftmenuli">���Ź���</li>
          <li class="leftmenuli_2"><a href="department_add.php" target="_self">���Ӳ���</a></li>     			   			
    			<li class="leftmenuli">�û�����</li>
          <li class="leftmenuli_2"><a href="user_add.php" target="_self">�����û�</a></li>
          <li class="leftmenuli_2"><a href="user_manage.php" target="_self" title="�ǹ���Ա�û���ֻ�ܱ༭�Լ���Ϣ">�û�����</a></li>
    			<li class="leftmenuli">��������</li>
          <li class="leftmenuli_2"><a href="user_mody_pwd.php" target="_self">�޸�����</a></li>
    			<li class="leftmenuli">���ݹ���</li>
          <li class="leftmenuli_2"><a href="user_handover.php" target="_self">�����ƽ�</a></li> 
    			<?
    				}
    				else
    				{
    			?>
    			<li class="leftmenuli">��������</li>
          <li class="leftmenuli_2"><a href="user_mody_pwd.php" target="_self">�޸�����</a></li>
     			
					<?
							}
					?>    			                  
    		</ul>
    	</div>