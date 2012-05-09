function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;


   for (i = 0; i < sText.length && IsNumber == true; i++)
   {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
      {
            IsNumber = false;
      }
   }
   return IsNumber;

   }

function GetControlValue(control_type, control_id)
{
    var val = "";
    if(control_type=="text")
    {
        val =  document.getElementById(control_id).value;
    }
    else if(control_type=="select-one")
    {
        var val =document.getElementById(control_id).options[document.getElementById(control_id).selectedIndex].value;        
    }
   
    return val;
}

function validate()
{    
    var error_msg="";    
    for(var i = 0 ; i<controls.length; i++)
    {        
        var control_type = document.getElementById(controls[i]).type;        
        var val = GetControlValue(control_type, controls[i]);                
        if(modes[i]=="empty")
        {            
            if(val=="")
            {
                error_msg+=errmsgs[i]+"\n";
            }            
        }
        else if(modes[i]=="numeric")
        {            
            if(!IsNumeric(val))
            {                
                error_msg+=errmsgs[i]+"\n";
            }
        }
        else if(modes[i]=="notequal")
        {            
            if(val==values[i])
            {                
                error_msg+=errmsgs[i]+"\n";                
            }            
        }        
    }    
    if(error_msg=="")
    {
            return true;
    }
    else
    {
        alert(error_msg);
        return false;
    }
}

function querySt(ji) {
var res = "-1"
hu = window.location.search.substring(1);
gy = hu.split("&");
for (i=0;i<gy.length;i++) {
ft = gy[i].split("=");
if (ft[0] == ji) {
res = ft[1];
}
}
return res;
}

