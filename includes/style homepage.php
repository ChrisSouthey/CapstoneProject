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
    width:518px;
    height:121px;
    background-color:#242024;
    display: flex;
    justify-content: center;
}
.headText{
    font-family:"Jersey 20";
    color:white;
    font-size:65px;
    display:flex;
    justify-content:center;
    margin-top:20px;
}
.barflex{
    display: flex;
}
.bar{
    display: flex;
    align-items: center;
    margin: 10px 0 10px 0;
}
.bar input{
    box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.25);
    font-size:23px;
    border-radius:10px;
    border:0;
    padding:10px;
    padding-left: 10px;
    margin-right: 10px;
}
.bar select{
    box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.25);
    font-size:20px;
    border-radius:10px;
    border:0;
    padding:10px;
    padding-right: 10px;
    font-family: "Jersey 20";
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
.errorbox{
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1;
    position: absolute;
    background: #DDDDDD;
    width: 300px;
    height: 200px;
    border-radius:30px;
    border: solid black 3px;
    margin-left: 100px;
    margin-top: 180px;
}
.errorbox p{
    font-family:"Jersey 20";
    font-size: 30px;
    width: 200px;
    height: 50px;
}
.errorbox button{
    width: 50px;
    height: 50px;
    border: none;
    background: #bf0000;
    font-family:"Jersey 20";
    font-size: 35px;
    color:white;
    margin-left: 10px;
}
.errorbox button:hover{
    cursor: pointer;
    background: #690505;
}
.erbx{
    display: flex;
    justify-content: center;
}
.left{
    max-width: 410px;
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
    margin-left:5px;
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


/* ------------------------------------------MainBox-------------*/
.mainbox{
    grid-area:m;
    width:950px;
    height:925px;
    background:#f3f4f5;
    overflow-y: auto;
    scrollbar-color:  #bf0000 #f3f4f5;
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
.adding{
    font-family: "Jersey 20";
    font-size: 20px;
    display: flex;
    align-items: center;
    margin-left: 780px;
    margin-top: 13px;
    z-index: 1;
    position: absolute;
}
.add{
    cursor: pointer;
}
.adding svg{
    width:30px;
    height: 30px;
    margin-left: 5px;
}
#addmenu{
    background-color:#DDDDDD;
    width: 370px;
    height: 234px;
    margin-left: 550px;
    position: absolute;
    border-radius: 40px;
    display: none;
    flex-direction: column;
    z-index: 1;
    position: absolute;
}
.groupi{
    box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.25);
    font-size:20px;
    border-radius:10px;
    border:0;
    padding:10px;
    padding-right: 50px;
    margin-left:35px;
    margin-top: 50px;
}
.subgroup{
    font-size:30px;
    color:white;
    background-color:#bf0000;
    border:0;
    padding:10px;
    margin-left: 35px;
    margin-top: 15px;
}
.loadgif{
    display: none;
    z-index: 1;
    position: absolute;
    margin-left: 420px;
    margin-top: 300px;
}
.groups{
    font-size: 50px;
    font-family: "Jersey 20";
    margin-left: 10px;
}
.cards{
    width: 810px;
    height: 250px;
    display: flex;
    flex-wrap: wrap;
    overflow-y: auto;
    padding: 30px;
}

.groups a{
    color:black;
    text-decoration: none;
}
.groups a:hover{
    text-decoration: underline;
    color: #bf0000;
}
.cardSmall{
    width: 190px;
    height: 240px;
    margin-right: 5px;
    margin-bottom: 5px;
    border: solid black 1px;
    border-radius: 10px;
    transition: all 0.3s ease;
}
.cardSmall:hover{
    transform: scale(1.2);
}


/* ------------------------------------------CardInfo-------------*/
.cardinfo{
    grid-area:c;
    width:518px;
    height:805px;
    background-color:#DDDDDD;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    scrollbar-color:  #bf0000 #DDDDDD;
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
    margin-top: 40px;
}
.cardImg{
    height: 500px;
    width: 400px;
    margin-bottom: 10px;
}
.cardlink{
    font-family: "Jersey 20";
    font-size:30px;
    text-align: center;
    color:black;
    text-decoration: none;
}
.cardlink:hover{
    color:#bf0000;
    text-decoration: underline;
}

/* ---------Container/Body-------------*/
#container{
    display:grid;
    grid-template-areas:
    'l l m m m s s s'
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