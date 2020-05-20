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

//fontcion permettant de validé le formulaire de modification de plat
function ValideChangeRecette(){
    
    //validation du nom du plat
    if(document.getElementById("IDNEWNOMPLAT").value=="")
    {
        document.getElementById("SpanErreurNewNomPlat").innerHTML="Veuillez entrer un nom de plat.";
        document.getElementById("IDNEWNOMPLAT").focus();
        return;
    }
    else if(document.getElementById("IDNEWNOMPLAT").value.length>40)
    {
        document.getElementById("SpanErreurNewNomPlat").innerHTML="Le nom de votre plat fait plus de 40 lettres.";
        document.getElementById("IDNEWNOMPLAT").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurNewNomPlat").innerHTML="";
    }
    
    //envoie du formulaire
    document.getElementById("CHANGERECETTE").submit();
    
}

//fontcion permettant de validé le formulaire d'insertion d'un cuisinier
function ValideInserCuisinier(){
    
    //validation du nom du cuisinier
    if(document.getElementById("IDNOMCUISINIER").value=="")
    {
        document.getElementById("SpanErreurNomCuisinier").innerHTML="Veuillez entrer un nom de cuisinier.";
        document.getElementById("IDNOMCUISINIER").focus();
        return;
    }
    else if(document.getElementById("IDNOMCUISINIER").value.length>40)
    {
        document.getElementById("SpanErreurNomCuisinier").innerHTML="Le nom de votre cuisinier fait plus de 40 lettres.";
        document.getElementById("IDNOMCUISINIER").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurNomCuisinier").innerHTML="";
    }
    
    //validation du mot de passe du cuisinier
    if(document.getElementById("IDMDPCUISINIER").value=="")
    {
        document.getElementById("SpanErreurMDPCuisinier").innerHTML="Veuillez entrer un mot de passe.";
        document.getElementById("IDMDPCUISINIER").focus();
        return;
    }
    else if(document.getElementById("IDMDPCUISINIER").value.length>40)
    {
        document.getElementById("SpanErreurMDPCuisinier").innerHTML="Votre mot de passe fait plus de 40 lettres.";
        document.getElementById("IDMDPCUISINIER").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurMDPCuisinier").innerHTML="";
    }
    
    //validation du statue du cuisinier
    if(document.getElementById("IDSTATUECUISINIER").value=="")
    {
        document.getElementById("SpanErreurStatueCuisinier").innerHTML="Veuillez entrer un statue.";
        document.getElementById("IDSTATUECUISINIER").focus();
        return;
    }
    else if(document.getElementById("IDSTATUECUISINIER").value.length>40)
    {
        document.getElementById("SpanErreurStatueCuisinier").innerHTML="Votre statue fait plus de 40 lettres.";
        document.getElementById("IDSTATUECUISINIER").focus();
        return;
    }
    else
    {
        document.getElementById("SpanErreurStatueCuisinier").innerHTML="";
    }
    
    //envoie du formulaire
    document.getElementById("AJCUISINIER").submit();
}