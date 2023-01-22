
// ★STEP2 ローカルストレージAPIの使用
//         データはサーバーではなく「ローカルストレージ」へ保存する
// https://jp.vuejs.org/v2/examples/todomvc.html
//        特に手を加える必要はないため、このコード↓は main.js ファイルの一番上の方に加え
// 実際にストレージに保存されるデータのフォーマットは、次のような JSON 
//     [
//       { "id": 1, "comment": "新しいToDo1", "state": 0 },
//       { "id": 2, "comment": "新しいToDo2", "state": 0 }
//     ]
var STORAGE_KEY = 'todos-vuejs-demo'
var todoStorage = {
  fetch: function () {
    var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
    todos.forEach(function (todo, index) {
      todo.id = index
    })
    todoStorage.uid = todos.length
    return todos
  },
  save: function (todos) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
  }
}

// ★STEP3 データの構想 :どんなデータが必要になりそうかを、ざっくりと考えておく
// *ToDo のリストデータ
//   ・要素の固有ID
//   ・コメント
//   ・今の状態
// *作業中・完了・すべて などオプションラベルで使用する名称リスト
// *現在絞り込みしている作業状態

// ★STEP1 コンストラクタ関数 Vue を使ってルートインスタンスを作成
var app = new Vue({
  el: '#app',
  
  //↓アプリケーションで使用したいデータは data オプションへ
  data: {
    // ★STEP5 localStorage から 取得した ToDo のリスト
    // ↓ToDo リストデータ用の空の配列を data オプションへ登録
    //    → データが何もない時でも配列として認識されるようにするため
    //    + data オプション直下のデータは後から追加ができないため初期値で宣言しておく必要があるため
    todos: [],
    // ★STEP11 抽出しているToDoの状態
      // 選択している options の value を記憶するためのデータ
      // 初期値を「-1」つまり「すべて」にする
    current: -1,
    // ★STEP11＆STEP13 各状態のラベル
    options: [
      { value: -1, label: 'すべて' },
      { value: 0, label: '作業中' },
      { value: 1, label: '完了' }
    ]
  },

  // current データの選択値によって表示させる ToDo リストの内容を振り分けるため「算出プロパティ」を使用
  // 算出プロパティ : データから別の新しいデータを作成する関数型のデータ
  computed: {

    // ★STEP12
    computedTodos: function () {
      // データ current が -1 ならすべて
      // それ以外なら current と state が一致するものだけに絞り込む
      return this.todos.filter(function (el) {
        return this.current < 0 ? true : this.current === el.state
      }, this)
    },

    // ★STEP13 文字列の変換処理 : 作業中・完了のラベルを表示する
    labels() {
      return this.options.reduce(function (a, b) {
        return Object.assign(a, { [b.value]: b.label })
      }, {})
      // キーから見つけやすいように、次のように加工したデータを作成
      // {0: '作業中', 1: '完了', -1: 'すべて'}
    }
  },

  // ★STEP8 ストレージへの保存の自動化（リロードしても消えないように）
  // ウォッチャはデータの変化に反応して、あらかじめ登録しておいた処理を自動的に行う
      // watch: { 
      //   監視するデータ: function(newVal, oldVal) {
      //     // 変化した時に行いたい処理      
      //   }
      // }
  watch: {
    // オプションを使う場合はオブジェクト形式にする
    todos: {
      // 引数はウォッチしているプロパティの変更後の値
      handler: function (todos) {
        todoStorage.save(todos)
      },
      // deep オプションでネストしているデータも監視できる
      deep: true
    }
  },

  // ★STEP9 保存されたリストを取得
  // 今回のタイミング「インスタンス作成時」では、 created メソッドを使うとよい
  created() {
    // インスタンス作成時に自動的に fetch() する
    this.todos = todoStorage.fetch()
  },

  // ↓使用するメソッド
  methods: {

    // ★STEP7 ToDo 追加の処理
    doAdd: function(event, value) {
      // ref で名前を付けておいた要素を参照
      var comment = this.$refs.comment
      // 入力がなければ何もしないで return
      if (!comment.value.length) {
        return
      }
      // { 新しいID, コメント, 作業状態 }
      // というオブジェクトを現在の todos リストへ push
      // 作業状態「state」はデフォルト「作業中=0」で作成
      this.todos.push({
        id: todoStorage.uid++,
        comment: comment.value,
        state: 0
      })
      // フォーム要素を空にする
      comment.value = ''
    },

    // ★STEP10 状態変更の処理  : item.state の値を反転
    doChangeState: function (item) {
      item.state = !item.state ? 1 : 0
    },

    // ★STEP10 削除の処理  : インデックスを取得し,配列メソッドの splice を使って削除
    doRemove: function (item) {
      var index = this.todos.indexOf(item)
      this.todos.splice(index, 1)
    }

  }
})

// ↓バージョン2系の場合、要らない？動いている
// Vue.createApp(app).mount('#app')