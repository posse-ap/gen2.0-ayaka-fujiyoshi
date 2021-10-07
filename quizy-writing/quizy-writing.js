//問題リストの作成
let questions_list = [];
questions_list.push(['たかなわ','たかわ','こうわ']);
questions_list.push(['かめいど','かめど','かめと']);
questions_list.push(['おかとまち','こうじまち','かゆまち']);

//クリック時の動作設定
function check(questions_id, selection_id, validAnswer_id){
    let answerLists = document.getElementsByName('selectionListName_' + questions_id);
    answerLists.forEach(function(answerList){
        answerList.style.pointerEvents = 'none';
    });

    let selectionButton = document.getElementById('selectionAnswerList_' + questions_id +'_'+ selection_id);
    let answerButton = document.getElementById('selectionAnswerList_' + questions_id +'_'+ validAnswer_id);
    selectionButton.className = 'wrongAnswerButton';
    answerButton.className = 'correctAnswerButton';

    let answerBox = document.getElementById('answerBox_' + questions_id);
    let answerText = document.getElementById('answerText_' + questions_id);
    // answerBox.style.display = 'block';
    if (selection_id == validAnswer_id) {
        answerText.className = 'correctAnswerBox';
        answerText.innerText = '正解！';
    } else {
        answerText.className = 'wrongAnswerBox';
        answerText.innerText = '不正解！';
    }
    answerBox.style.display = 'block';
}

//問題表示の設定
function createQuestion(questions_id, selectionList, validAnswer_id){
    let contents =  `<div class="questions">`
                 +  `<h1>${questions_id+1}.この地名はなんて読む？</h1>`
                 +  `<img src="img/${questions_id+1}.png" alt="問題の写真">`
                 +  `<ul>`;

    selectionList.forEach(function(selection,index){
        contents += `<li id="selectionAnswerList_${questions_id}_${index}"`
                 +  `name="selectionListName_${questions_id}"` 
                 +  `class="selectionAnswerList"` 
                 +  `onclick="check(${questions_id},${index},${validAnswer_id})">${selection}</li>`
    });
    
        contents += `<li id="answerBox_${questions_id}" class="answerBox">`
                 +  `<span id="answerText_${questions_id}"></span><br>`
                 +  `<span>正解は「${selectionList[validAnswer_id]}」です！</span>`
                 +  `</li>`
                 +  `</ul>`
                 +  `</div>`;
    document.getElementById('main').insertAdjacentHTML('beforeend',contents);
}

//問題のシャッフルと問題表示の設定を呼び出す
function createHtml(){
    questions_list.forEach(function(questions,index){
        const answer = questions[0] //正しい答えを取得・記憶

        //配列をランダムにする
        for (let k = questions.length - 1; k > 0; k--) { 
            const j = Math.floor(Math.random() * (k + 1));  
            [questions[j], questions[k]] = [questions[k], questions[j]]; 
        }

        createQuestion(index,questions,questions.indexOf(answer));
    });
}

//htmlの表示設定
window.onload = createHtml;