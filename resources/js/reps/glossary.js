Glossary = class {
    #array;
    #glossaryTextarea;

    constructor(glossaryTextarea){
        this.#glossaryTextarea = glossaryTextarea;
        this.setArray(this.#glossaryTextarea.val().split('\n'));
    }

    getArray = function(){
        return this.#array;
    }

    setArray = function(array){
        this.#array = array;
        var content = '';
        this.#array.forEach(el => {
            content = content + el + '\n';
        });   
        this.#glossaryTextarea.val(content.substr(0,content.length-1));
    }

}