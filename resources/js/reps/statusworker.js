StatusWorker = class {
    #statusdiv;
    #status;
    #valdiv;
    #val;
    
    constructor (statusdiv, valdiv){
        this.#statusdiv = statusdiv;
        this.#status = this.#statusdiv.text();
        this.#valdiv = valdiv;
        this.#val = this.#valdiv.text();
    }

    setStatus = function(status){
        this.#status = status;
        this.#statusdiv.text(this.#status);
    }

    getStatus = function(){
        return this.#status;
    }

    setStatusVal = function(val){
        this.#val = val;
        this.#valdiv.text(this.#val);
    }

    getStatusVal = function(){
        return this.#val;
    }
}