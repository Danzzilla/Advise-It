class DataTrain{
    data;

    constructor(id){
        this.data = {
            ID: id,
            Fall1: [],
            Fall2: [],
            Winter1: [],
            Winter2: [],
            Spring1: [],
            Spring2: [],
            Summer1: [],
            Summer2: [],
            deleted: []
        };
    }

    addClassNote(id, content){
        this.data[id].push(content);
    }

    flush(){
        $.ajax({
            method: "POST",
            url: "model/save.php",
            data: JSON.stringify(this.data)
        })

        // let xhr = new XMLHttpRequest();
        //
        // xhr.open("POST", "", true);
        // xhr.setRequestHeader("Content-Type", "application/json; charset: UTF-8");
        //
        // let json = JSON.stringify(this.data);
        // xhr.send(json);
    }

}