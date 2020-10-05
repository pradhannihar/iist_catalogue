function change()
{   
    /*let ele_ = document.getElementById(id);
    let class_nm = ele_.className;
    console.log(ele_.getElementsByTagName("input")[0].display)
    if(ele_.getElementsByTagName("input")[0].style.display=='')
        {ele_.className = class_nm + " chng";
        
        ele_.getElementsByTagName("input")[0].style.display='inline-block';
        ele_.getElementsByTagName("input")[0].focus();
        ele_.getElementsByTagName("input")[0].style.transform="translateX(-80px)";
        
        ele_.getElementsByTagName("input")[0].style.width="70%";
    }*/
    console.log("Changed");


}

function focusFun(id){
    console.log("focused");
    document.getElementById(id).classList.add("chng");
}

function blurFun(id){
    console.log("blured");
    let div_ele = document.getElementById(id)
    if(div_ele.getElementsByTagName("input")[0].value=="")
    div_ele.classList.remove("chng");
}

function vali_psw(id)
{   
    // Check the validity of the entered password
    let letter  = document.getElementById(id);
    let value = letter.getElementsByTagName("input")[0].value;
    
    var lowerCaseLetters = /[a-z]/g;
    var numbers = /[0-9]/g;
    var upperCaseLetters = /[A-Z]/g;
    console.log(value);
    if(value.length >= 8 & Boolean(value.match(lowerCaseLetters)) & 
        Boolean(value.match(upperCaseLetters))
         &Boolean(value.match(numbers))){
        letter.classList.remove("invalid");
        letter.classList.add("valid");
        is_pas_val = true;
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
        is_pas_val = false;
    }
  }

function match_pass(id_pass, id_con_pass)
{   
    console.log("Pass checked");
    let pass_ = document.getElementById(id_pass);
    let pass_con = document.getElementById(id_con_pass);

    let val1 = pass_.getElementsByTagName("input")[0].value;
    let val2 = pass_con.getElementsByTagName("input")[0].value;

    console.log(val1, val2);
    if(val1 == val2 & is_pas_val)
    { pass_con.classList.add("valid");
      pass_con.classList.remove("invalid");
    }
    else 
    {
      pass_con.classList.remove("valid");
      pass_con.classList.add("invalid");
    }
}

var is_pas_val = false;