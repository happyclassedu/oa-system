    	<div id="leftmenu">
    		<ul id="leftmenuul">
    			<?
    			if (trim($_SESSION["userdlname"])=="admin")
    			{
    			?> 
    			<li class="leftmenuli">部门管理</li>
          <li class="leftmenuli_2"><a href="department_add.php" target="_self">增加部门</a></li>     			   			
    			<li class="leftmenuli">用户管理</li>
          <li class="leftmenuli_2"><a href="user_add.php" target="_self">增加用户</a></li>
          <li class="leftmenuli_2"><a href="user_manage.php" target="_self" title="非管理员用户，只能编辑自己信息">用户管理</a></li>
    			<li class="leftmenuli">个人设置</li>
          <li class="leftmenuli_2"><a href="user_mody_pwd.php" target="_self">修改密码</a></li>
    			<li class="leftmenuli">数据管理</li>
          <li class="leftmenuli_2"><a href="user_handover.php" target="_self">工作移交</a></li> 
    			<?
    				}
    				else
    				{
    			?>
    			<li class="leftmenuli">个人设置</li>
          <li class="leftmenuli_2"><a href="user_mody_pwd.php" target="_self">修改密码</a></li>
     			
					<?
							}
					?>    			                  
    		</ul>
    	</div>