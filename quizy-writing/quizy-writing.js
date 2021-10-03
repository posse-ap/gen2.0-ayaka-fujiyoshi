//問題リストの作成
let questions_list = [];
questions.push = ['たかなわ','たかわ','こうわ'];
questions.push = ['かめいど','かめど','かめと'];
questions.push = ['おかとまち','こうじまち','かゆまち'];

//クリック時の動作設定
//問題表示の設定
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