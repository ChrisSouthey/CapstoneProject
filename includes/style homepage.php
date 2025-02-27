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
::-webkit-scrollbar {
    display: none;
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
.bar{
    display: flex;
    align-items: center;
    margin-top: 25px;
}
.bar input{
    box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.25);
    font-size:40px;
    border-radius:10px;
    border:0;
    padding:10px;
    padding-right: 100px;
    margin-right:30px;
}
.bar svg{
    margin-left: 15px;
}
.bar select{
    box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.25);
    font-size:20px;
    border-radius:10px;
    border:0;
    padding:10px;
}
.searcherr{
    display: flex;
    flex-direction: column;
    font-family: "Jersey 20";
    color: white;
    font-size: 20px;
}
.searcherr p{
    margin-left: 80px;
    margin-top: 5px;
}
.barsvg{
    display: flex;
}

/* ---------Filter-------------*/
.filter{
    grid-area:f;
    width:415px;
    height:730px;
    background-color:#DDDDDD; 
}
.filtText{
    font-family: "Jersey 20";
    font-size:56px;
    font-size:56px;
    margin-left:150px;
}
.dropdown-container {
    width: 200px;
    width: 200px;
    background: #333;
    padding: 10px;
    border-radius: 5px;
}
.dropdown {
    margin-bottom: 10px;
}
.dropdown-header {
    background: #444;
    padding: 8px;
    cursor: pointer;
    color: white;
    border-radius: 3px;
}
.dropdown-content {
    display: none;
    padding: 5px;
    background: #555;
    border-radius: 3px;
}
.dropdown-content label {
    display: block;
    color: white;
    padding: 2px;
    margin-top:20px;
    margin-top:20px;
}


/* ---------Account Settings-------------*/
.accsettings{
    display:flex;
    height:75px;
    background-color:#242024;
    font-family:"Jersey 20";
    font-size:50px;
    align-items:center;
}
.accsettings a{
    color:white;
    text-decoration:none;
}
.accsettings a:hover{
    color:#bf0000;
    text-decoration:underline;
}
.accsettings svg{
    margin-left:15px;
}
.logout{
    margin-left:15px;
}


/* ---------MainBox-------------*/
.mainbox{
    grid-area:m;
    width:950px;
    height:780px;
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
.login a:hover{
    color:#FFFFFF;
    text-decoration:underline;
}
.user{
    display:flex;
    margin-bottom:33px;
}
.pass{
    display:flex;
    margin-bottom:33px;
}
svg{
    margin-right:18px;
}
.error{
    font-family:"Jersey 20";
    font-size:25px;
    margin-left:20px;
}
.errLog{
    display:flex;
    align-items:center;
}
.eye{
    margin-left:18px;
}
.eye:hover{
    cursor:pointer;
}

/* ---------CardInfo-------------*/
.cardinfo{
    grid-area:c;
    width:510px;
    height:926px;
    background-color:#DDDDDD;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.card{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.cardName{
    font-family: "Jersey 20";
    font-size:30px;
    text-align: center;
    margin-bottom: 10px;
}
.cardImg{
    height: 500px;
    width: 400px;
    margin-bottom: 40px;
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
    width:100%;
}




</style>