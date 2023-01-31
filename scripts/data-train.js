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
        //check if added content is empty or whitespace
        if(content.replace(/\s/g, "") != ""){
            this.data[id].push(content);
        }
    }

    flush(){
        $.ajax({
            method: "POST",
            url: "model/save.php",
            data: JSON.stringify(this.data)
        })
    }

}