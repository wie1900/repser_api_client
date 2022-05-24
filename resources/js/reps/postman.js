Postman = class{
    #source;
    #glossary;
    #statusWorker;

    constructor(source, glossary, statusworker){
        this.#source = source;
        this.#glossary = glossary;
        this.#statusWorker = statusworker;
    }

    sendPackage = function(){
        this.setSource();
        
        if(this.#source.getArray()[0].length > 1){
            for(var i=0;i<this.#getSource().length;i++){
                this.#sendpart(i);
            }
    
            this.#setStatus('Final - parts sent:');
            this.#setStatusVal(i + '/' + this.#source.arrayLength + ' segs');    
        }else{
            this.#setStatus('Source text MUST contain more lines!');
        }
    }

    #sendpart = function(partNumber){
        this.#setStatus('Sending...');
        this.#setStatusVal(partNumber + ' from ' + this.#source.getArray().length);
        this.#processByAjax(this.#source.getArray()[partNumber], this.#glossary);
    }

    #processByAjax = function(sourceArr, glossary){
        try{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                async: false,
                url: "/getglossary",
                dataType: 'json',
                data: {source: sourceArr, glossary: glossary.getArray()},
                // headers: {
                //     "Authorization": "Bearer 22|XXXXXXX"
                // },
                success: function (result){
                    glossary.setArray(result.glossary);
                },
                error: function(e) {
                    console.log(e);
                 }
            });    
        }catch(e){
            callback({'error':'Cross Origin Issue'});
        }
    }

    setSource = function(){
        this.#source.setArray();
    }

    #getSource = function(){
        return this.#source.getArray();
    }

    #setStatus = function(status){
        this.#statusWorker.setStatus(status);
    }

    #getStatus = function(){
        return this.#statusWorker.getStatus();
    }    

    #setStatusVal = function(val){
        this.#statusWorker.setStatusVal(val);
    }

    #getStatusVal = function(){
        return this.#statusWorker.getStatusVal();
    }    

    setMaxInPart = function(val){
        this.#source.setMaxInPart(val);
    }

    getMaxInPart = function(){
        return this.#source.getMaxInPart();
    }    

}