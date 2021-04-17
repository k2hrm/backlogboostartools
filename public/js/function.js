function addpj() {
    var likey = document.createElement("li");
    likey.innerHTML = 'キー:<input type="text" name="project_keys[]">';
    var liasaignee = document.createElement("li");
    liasaignee.innerHTML = '担当者:<input type="text" name="asignee_ids[]">';
    var upid = document.createElement("input");
    upid.innerHTML = '<input type="hidden" name="user_project_ids[]" value="">';

    document.getElementById('user_projects').appendChild(likey);
    document.getElementById('user_projects').appendChild(liasaignee);
}

function check() {
    if (window.confirm('送信してよろしいですか？')) { // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
    } else { // 「キャンセル」時の処理
        window.alert('キャンセルされました'); // 警告ダイアログを表示
        return false; // 送信を中止
    }
}