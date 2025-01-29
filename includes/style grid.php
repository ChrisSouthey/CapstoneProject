<style>
@charset "UTF-8";

*,
*::before,
*::after {
    margin: 0;
    padding: 0;
}
body{
    width:100%;
    height:100%;
}

/* ---------Logo-------------*/
.logo{
    grid-area:l;
    width:100%;
    height:100%;
    background-color: #BF0000;
    display: flex;
    justify-content:center;
}

.logotext{
    font-family:monofett;
    color:white;
    font-size:75px;
    margin-top:10px;
    margin-right:2px;
}


/* ---------SearchBar-------------*/
.search{
    grid-area:s;
    width:100%;
    height:121px;
    background-color:#242024;
    border-radius: 0px 0px 30px 30px;
}
.headText{
    font-family:"Jersey 20";
    color:white;
    font-size:65px;
    display:flex;
    justify-content:center;
    margin-top:20px;
}

/* ---------Filter-------------*/
.filter{
    grid-area:f;
    width:415px;
    height:100%;
    background-color:#DDDDDD; 
}

/* ---------MainBox-------------*/
.mainbox{
    grid-area:m;
    width:950px;
    height:805px;
    background:#f3f4f5;
}
.infoBox{
    display:flex;
    width: 605px;
    height: 192px;
    background-color:#BF0000;
    border-radius: 40px;
    margin-left: 160px;
    margin-top:47px;
    font-family:"Jersey 20";
    color:white;
    font-size:45px;
    font-weight:400;
}
.infoBox p{
    margin-top:5px;
    margin-left:30px;
}
.loginBox{
    display:flex;
    width: 605px;
    height: 192px;
    background-color:#242024;
    border-radius: 40px;
    margin-left: 160px;
    margin-top:47px;
    font-family:"Jersey 20";
    color:white;
    font-weight:400;
}
.loginText{
    margin-left:47px;
    margin-top:10px;
}
p.login{
    font-size:50px;
    width: 500px;
}
p.register{
    font-size:40px;
    margin-top:15px;
}
.register a{
    color:#BF0000;
    text-decoration:none;
}
.login a{
    color:#BF0000;
    text-decoration:none;
}
a:hover{
    color:#FFFFFF;
    text-decoration:underline;
}

/* ---------CardInfo-------------*/
.cardinfo{
    grid-area:c;
    width:555px;
    height:926px;
    background-color:#DDDDDD;
}

/* ---------Footer-------------*/
.footer{
    grid-area:ft;
    width:100%;
    height:46px;
    background: #BF0000;
}

/* ---------Container/Body-------------*/
#container{
    display:grid;
    grid-template-areas:
    'l l s s s c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'f f m m m c c c'
    'f f m m m c c c';
    background-color: #f3f4f5;
    height:100%;
}




</style>