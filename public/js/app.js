//import './bootstrap';

EventTarget.prototype.loader = function () {
    const loadingText = this.dataset.loadText;
    const initialState = this.innerHTML;
    const self = this;
    return {
        show: (text = "Aguarde") => {
            self.disabled = true;
            self.innerHTML =
                loadingText ||
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${text}`;
        },
        hide: () => {
            self.innerHTML = initialState;
            self.disabled = false;
        },
    };
};

const Pagination = (() => {
    return {
        container: null,

        handlerClick: (e) => {
            throw Error("handlerClick not implemented");
        },

        linkRender(data) {
            let paginacao = this.container;

            paginacao.innerHTML = "";

            data.links.forEach((link) => {
                let lii = document.createElement("li");
                lii.classList.add("page-item");

                if (link.url) {
                    lii.classList.add(link.active ? "active" : "a");
                    lii.innerHTML = `
                        <a class="page-link" href="#" onclick="Pagination.handlerClick(event)" data-page="${
                            link.url.split("page=")[1]
                        }">${link.label}</a>
                    `;
                } else {
                    lii.classList.add("disabled");
                    lii.innerHTML = `
                        <span class="page-link">${link.label}</span>
                    `;
                }
                paginacao.appendChild(lii);
            });
        },
    };
})();
//HELPERS functions
const getCEP = async (event) => {
    event.preventDefault();

    const cep = event.target.closest("form").querySelector("#cep");

    try {
        if (cep && FILTER_CEP.test(cep.value)) {
            let response = await fetch(
                `https://viacep.com.br/ws/${cep.value}/json/`
            );
            if (!response.ok) {
                throw new Error("CEP não encontrado");
            }
            return await response.json();
        }
    } catch (error) {
        console.log(error.message);
    }
};

const requestPost = async (url, form, refer) => {
    return await fetch(`${url}`, {
        method: "POST",
        "Content-Type": "multipart/form-data",
        headers: {
            "X-CSRF-TOKEN": refer.querySelector(`[name="_token"]`).value,
            "X-Requested-With": "XMLHttpRequest",
        },
        body: form,
    })
        .then(async (resp) => await resp.json())
        .then((json) => {
            return json;
        });
};

const formValidate = (event, form) => {
    let errors = false;
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        errors = true;
    }
    form.classList.add("was-validated");
    return errors && (!event.detail || event.detail === 1);
};

const handlerFormValidateServerSide = (form, error) => {
    for (const [key, value] of Object.entries(error.error)) {
        let input = form.querySelector(`[name="${key}"]`);
        if (input) {
            input.setCustomValidity(value);

            input.addEventListener("input", function () {
                input.setCustomValidity("");
                input.checkValidity();
            });
        }
    }
};

const showInvalidTab = (formRef) => {
    let invalidInput = formRef.querySelector(":invalid");
    if (invalidInput) {
        let tabPane = invalidInput.closest(".tab-pane");
        if (tabPane) {
            let id = tabPane.getAttribute("id");
            if (id) {
                let tab = document.querySelector(
                    `#myTab button[data-bs-target="#${id}"]`
                );
                if (tab) {
                    // bootstrap.Tab.getInstance(tab).show()
                    tab.dispatchEvent(new Event("click"));
                }
            }
        }
    }
};

function showToast(message, type = "info") {
    // Cria o elemento do toast
    const toastElement = document.createElement("div");
    toastElement.className = `toast align-items-center text-bg-${type} border-0`;
    toastElement.role = "alert";
    toastElement.ariaLive = "assertive";
    toastElement.ariaAtomic = "true";

    // Estrutura interna do toast
    toastElement.innerHTML = `
      <div class="d-flex">
        <div class="toast-body">
          ${message}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    `;

    // Adiciona o toast ao container
    const toastContainer = document.getElementById("toastContainer");
    toastContainer.appendChild(toastElement);

    // Inicializa o toast
    const bootstrapToast = new bootstrap.Toast(toastElement);
    bootstrapToast.show();

    // Remove o toast após ele ser escondido
    toastElement.addEventListener("hidden.bs.toast", () => {
        toastElement.remove();
    });
}

class ServeSideError extends Error {
    constructor(errorjson = {}, ...params) {
        super(...params);
        if (Error.captureStackTrace) {
            Error.captureStackTrace(this, ServeSideError);
        }
        this.name = "CustomErrorValidation";
        this.error = errorjson;
        this.date = new Date();
    }
}
