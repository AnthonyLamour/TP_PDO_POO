//fontcion permettant de validé le formulaire de login
function ValideLogin(){
 
    //validation du login
    if(document.getElementById("IDLOGIN").value=="")
    {
        document.getElementById("SpanErreurLogin").innerHTML="Veuillez entrer un login.";
        document.getElementById("IDLOGIN").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurLogin").innerHTML="";
    }
    
    //validation du password
    if(document.getElementById("IDPASSWORD").value=="")
    {
        document.getElementById("SpanErreurPassword").innerHTML="Veuillez entrer un password.";
        document.getElementById("IDPASSWORD").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurPassword").innerHTML="";
    }
    
    //envoie du formulaire
    document.getElementById("LOG").submit();
}