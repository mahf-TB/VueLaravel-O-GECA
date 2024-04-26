import { createStore } from 'vuex'

export default createStore({
  state: {
    visible:false
  },
  getters: {
    isVisible(state){
      return state.visible;
    }
  },
  mutations: {
    setValueModal(state, value) {
      state.visible = value; 
    },
  },
  actions: {
    actionValueModal({ commit }) {
          commit('setValueModal', true)
    },
  },
  modules: {
  }
})
