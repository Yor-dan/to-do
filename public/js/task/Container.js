class Container {
  #container;
  
  constructor() {
    this.#container = [];
    Object.seal(this);
  };

  add(item) {
    this.#container.push(item);
  };

  get items() {
    return this.#container;
  };

  remove(id) {
    this.#container = this.#container.filter(item => item.id !== id);
  };
};

export default new Container();