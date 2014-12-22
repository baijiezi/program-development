function onlogin(url,txt)
{
	if(confirm(txt))
	{
		window.location = url; 
	}
	else
	{
		return false;
	}
	
}