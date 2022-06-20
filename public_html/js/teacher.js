function speak(message, options){
    var robo = new SpeechSynthesisUtterance();
    robo.text = message || 'Hello! I am a voice assistent. And I am waiting for your message';
    robo.lang = 'en-US';
    // robo.rate = 0.7;
    robo.pitch = 1;
    robo.volume = 1;

    // console.log(robo);
    // Speach Chunk Analysyser. // Very Impontent
    var speechUtteranceChunker = function (utt, settings, options) {
        settings = settings || {};
        var newUtt;
        var txt = (settings && settings.offset !== undefined ? utt.text.substring(settings.offset) : utt.text);
        if (utt.voice && utt.voice.voiceURI === 'native') { // Not part of the spec
            newUtt = utt;
            newUtt.text = txt;

            newUtt.addEventListener('end', function (e) {
                if (speechUtteranceChunker.cancel) {
                    speechUtteranceChunker.cancel = false;
                }
                if (options && options.end !== undefined) {
                    options.end(e);
                }
            });
        }
        else {
            var chunkLength = (settings && settings.chunkLength) || 160;
            var pattRegex = new RegExp('^[\\s\\S]{' + Math.floor(chunkLength / 2) + ',' + chunkLength + '}[.!?,]{1}|^[\\s\\S]{1,' + chunkLength + '}$|^[\\s\\S]{1,' + chunkLength + '} ');
            var chunkArr = txt.match(pattRegex);
    
            if (chunkArr[0] === undefined || chunkArr[0].length <= 2) {
                //call once all text has been spoken...
                if (options && options.end !== undefined) {
                    options.end();
                }
                return;
            }
            var chunk = chunkArr[0];
            newUtt = new SpeechSynthesisUtterance(chunk);
            var x;
            for (x in utt) {
                if (utt.hasOwnProperty(x) && x !== 'text') {
                    newUtt[x] = utt[x];
                }
            }

            newUtt.addEventListener('end', function () {
                if (speechUtteranceChunker.cancel) {
                    speechUtteranceChunker.cancel = false;
                    return;
                }
                settings.offset = settings.offset || 0;
                settings.offset += chunk.length - 1;
                speechUtteranceChunker(utt, settings, options);
            });
        }
        newUtt.addEventListener('start', function (e) {
            if (options && options.start !== undefined) {
                options.start(newUtt);
            }
        });
    
        if (settings.modifier) {
            settings.modifier(newUtt);
        }
        // console.log(newUtt); //IMPORTANT!! Do not remove: Logging the object out fixes some onend firing issues.
        //placing the speak invocation inside a callback fixes ordering and onend issues.
        setTimeout(function () {
            speechSynthesis.speak(newUtt);
        }, 0);
    };

    // Speak this robot
    speechUtteranceChunker(robo, {
        chunkLength: 160
    },{
        start: function(e){
            // console.log(e);
            (options && options.start)? options.start(e) : console.log('Robo speak: '+e.text);
        },
        end: function(e){
            //some code to execute when done
            // console.log('done');
            (options && options.end)? options.end(e): console.log('Robo ending speak');
        } 
    });
}

function listen(options) {
    var recognition;
    if("SpeechRecognition" in window){
        recognition = new SpeechRecognition();
    }
    else if("webkitSpeechRecognition" in window){
        recognition = new webkitSpeechRecognition();
    }
    else if("mozSpeechRecognition" in window){
        recognition = new mozSpeechRecognition();
    }else {
        console.log("Speech Recognition Not Available")
    }
    // var recognition = new webkitSpeechRecognition(); // It is works only chrome, safari, edge and not wokring mozila, ie, opera
    recognition.continuous = false;
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;
    recognition.start();
    // console.log(recognition);

     // Callback Function for the onStart Event
    recognition.onstart = (e) => {
        (options && options.start)? options.start(e) : console.log('Listen '+e.type);
    };
    recognition.onend = (e) => {
        (options && options.end)? options.end(e): console.log('Listen '+e.type);
    };

    // Listen this content
    if(options && options.message){
        recognition.onresult = (e) => {
            (options && options.message)? options.message(e.results[0][0].transcript): console.log('Listen: '+e);
        }
    }
    // error
    if(options && options.error){
        recognition.onerror = (e) => {
            (options && options.error)? options.error(e) : console.log('Listen ',e.type, e);
        };
    }

    // If message option not set
    if(!(options && options.message)){
        return new Promise(resolve => {
            recognition.onresult = (e) => {
                resolve(e.results[0][0].transcript);
            }
        }, reject => {
            recognition.onerror = (e) => {
                reject(e.error);
            };
        });
    }
}

var talk = document.getElementById('talk');
talk.addEventListener('click', async function() {
    var data = await listen({
        start: ()=>{
            talk.classList.remove('btn-success');
            talk.classList.add('btn-danger');
            talk.disabled = true;
        },
        end: ()=>{
            talk.classList.remove('btn-danger');
            talk.classList.add('btn-success');
            talk.disabled = false;
        }
    });
    // console.log(data);
    CKEDITOR.instances['editor'].insertText(data+' ');
    
});

var say = document.getElementById('say');
say.addEventListener('click', async function() {
    var content = CKEDITOR.instances['editor'].getSnapshot();
    var dom=document.createElement("DIV");
    dom.innerHTML=content;
    var plain_text=(dom.textContent || dom.innerText);
    // console.log(plain_text);

    speak(plain_text, {
        start: ()=>{
            say.classList.remove('btn-success');
            say.classList.add('btn-danger');
            say.disabled = true;
        },
        end: ()=>{
            say.classList.remove('btn-danger');
            say.classList.add('btn-success');
            say.disabled = false;
        },
        error: (e) =>{
            console.log(e);
        }
    });
});