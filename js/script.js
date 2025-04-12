
function showMobilemenu(){
    const openMobilemenupage = document.querySelector('.mobileMenuTray')
    const mobileMenubtn = document.querySelector('.mobileMenu')
    const hideMobilebtn = document.querySelector('.closeMenu')

    openMobilemenupage.style.display = "block";
    mobileMenubtn.style.display = "none";
    hideMobilebtn.style.display = "block";
}

function closeMobilemenu(){
    const openMobilemenupage = document.querySelector('.mobileMenuTray')
    const mobileMenubtn = document.querySelector('.mobileMenu')
    const hideMobilebtn = document.querySelector('.closeMenu')

    openMobilemenupage.style.display = "none";
    mobileMenubtn.style.display = "block";
    hideMobilebtn.style.display = "none";
}





function showSignup(){
    const loginPage = document.querySelector('.LoginHolder');
    const signupPage = document.querySelector('.signUpFOrm');

    loginPage.style.display = "none";
    signupPage.style.display = "block";
}

function showLogin(){
    const loginPage = document.querySelector('.LoginHolder');
    const signupPage = document.querySelector('.signUpFOrm');

    loginPage.style.display = "block";
    signupPage.style.display = "none";
}


    function SwitchPW(){
        var x = document.getElementById("password");
        var x3 = document.getElementById("password3");
        var x2 = document.getElementById("confirm_password");

        if(x.type ==="password"){
            x.type = "text";
            x2.type = "text";
            x3.type = "text";
            
        }
        else
        {
            x.type = "password";
            x2.type = "password";
            x3.type = "password";
        }

        }













//Close Preview Book Dialogue
function closeBtn(){
    const minPage = document.querySelector('.closeScrn');
    const prePage = document.querySelector('.hangingPreview');

    prePage.style.display = "none";

}







//Close Borrow Book Dialogue
function closeM(){
    const clsborrowbtn = document.querySelector('.closeScrn2');
    const borrowPrePage = document.querySelector('.hangingPreview2');

    borrowPrePage.style.display = "none";

}


function closeAddbookbtn(){
    const addFormpage = document.querySelector('.hangingPreview3')

    addFormpage.style.display="none";
}

