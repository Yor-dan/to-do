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
    this.#container.sort((a, b) => a.isDone - b.isDone);
    return this.#container;
  };

  remove(id) {
    this.#container = this.#container.filter(item => item.id !== id);
  };
};

export default new Container();