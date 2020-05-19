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

//fontcion permettant de validé le formulaire d'insertion de plat
function ValideInserPlat(){
    
    //validation du nom du plat
    if(document.getElementById("IDNOMPLAT").value=="")
    {
        document.getElementById("SpanErreurNomPlat").innerHTML="Veuillez entrer un nom de plat.";
        document.getElementById("IDNOMPLAT").focus();
        return;
    }
    else if(document.getElementById("IDNOMPLAT").value.length>40)
    {
        document.getElementById("SpanErreurNomPlat").innerHTML="Le nom de votre plat fait plus de 40 lettres.";
        document.getElementById("IDNOMPLAT").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurNomPlat").innerHTML="";
    }
    
    //envoie du formulaire
    document.getElementById("AJPLAT").submit();
    
}