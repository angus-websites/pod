import {defineStore} from "pinia";

export let useEntryStore = defineStore("entry", {

  // State
  state(){
    return {
      entry: null
    };
  },

  // Methods
  actions: {

    init(entry){
      this.entry = entry;
    },

  },
})