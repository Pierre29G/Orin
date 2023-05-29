window.addEventListener("DOMContentLoaded", function() {
    const headerarrow = document.querySelector('#arrow');

        if (headerarrow) {

            headerarrow.onclick = function(){
                headerarrow.classList.toggle('closed');
                document.querySelector('header').classList.toggle('closed');
            }
        }


    //code pour le tutoriel
    const buttonone = document.querySelector('#onboardingone .button');

    if(buttonone) {

        buttonone.onclick = function(){
            document.querySelector('#onboardingtwo').classList.remove('hidden');
            document.querySelector('#onboardingone').classList.add('hidden');
        }

        document.querySelector('#onboardingtwo .button').onclick = function(){
            document.querySelector('#onboardingthree').classList.remove('hidden');
            document.querySelector('#onboardingtwo').classList.add('hidden');
        }

        document.querySelector('#onboardingthree .button').onclick = function(){
            document.querySelector('#onboardingthree').classList.add('hidden');

            //Créé un cookie pour ne pas refaire le tutoriel à chaque visite
            var today = new Date();
            var expire = new Date();
            var nDays=365
                expire.setTime(today.getTime() + 3600000*24*nDays);
                document.cookie = "tutorial=true;expires="+expire.toGMTString();
        }

        document.querySelector('#help').onclick = function(){
            document.querySelector('#onboardingone').classList.remove('hidden');
        }

    }
}, false);