const ajaxCall = () => {
  const accordionHeaders         = document.querySelectorAll("#accordionHeader");
  const tourNextBtn              = document.querySelectorAll("#tourNextBtn");
  const step2Groups              = document.querySelectorAll(".step_2-wrap");
  const stepGroupsLoadWrap       = document.querySelectorAll(".step-2-groups");
  const tournamentDuration       = document.querySelectorAll("#tournamentDuration");
  const tournamentStarts         = document.querySelectorAll("#tournamentStart");
  const tournamentGroups         = document.querySelectorAll("#tournamentGroups");
  const saveTournamentGroupTeams = document.querySelectorAll("#tourTeamsGroup");
  const shortCodeGenerator       = document.querySelectorAll(".generate > input");
  const saveTournamentMatches    = document.querySelectorAll("#matchesForm");
  const deleteBtn                = document.querySelectorAll("#deleteBtn");
  const tourTypeFootball     	   = document.querySelector('#tourType_football');
	const tourTypeBasketball  	   = document.querySelector('#tourType_basketball');
	const tourPreview			         = document.querySelector('.settings-page__content--preview');


  // Tournament accordion Next Button
  for (let i = 0; i < accordionHeaders.length; i++) {
    tourNextBtn[i].addEventListener("click", function (e) {
      e.preventDefault();
      const tourGroups = tournamentGroups[i].value;
      const tourID = tourNextBtn[i].dataset.tour;
      const tourDuration = tournamentDuration[i].value;
      const tourStart = tournamentStarts[i].value;

      fetch(my_ajax_object.ajax_url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "accordionSaveData",
          tourID: tourID,
          tourDuration: tourDuration,
          tourGroups: tourGroups,
          tourStart: tourStart,
        }),
      })
        .then((response) => response.text())
        .then((data) => {
          step2Groups[i] ? (step2Groups[i].style.display = "block") : "";
        })
        .catch((error) => {
          console.error("Error:", error);
        });

      fetch(my_ajax_object.ajax_url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "accordionLoadGroups",
          tourGroups: tourGroups,
        }),
      })
        .then((response) => response.text())
        .then((data) => {
          tournamentDuration[i].setAttribute("readonly", "readonly");
          tournamentStarts[i].setAttribute("readonly", "readonly");
          tournamentGroups[i].setAttribute("readonly", "readonly");
          tourNextBtn[i].setAttribute("disabled", "disabled");
          tourNextBtn[i].style.display = "none";
          stepGroupsLoadWrap[i].innerHTML = data;
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });

    saveTournamentGroupTeams[i].addEventListener("click", function (e) {
      e.preventDefault();

      const tourID = saveTournamentGroupTeams[i].dataset.tour;
      const groupField = stepGroupsLoadWrap[i].querySelectorAll("textarea");
      const groupTeams = [];

      groupField.forEach((element) => {
        groupTeams.push(element.value);
      });

      fetch(my_ajax_object.ajax_url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "accordionGroupsTeamSave",
          tourID: tourID,
          tourTeams: groupTeams,
        }),
      })
        .then((response) => response.text())
        .then((data) => {
          shortCodeGenerator[i].value = '[shortcode id="13" sport="football" ]';
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });

    deleteBtn[i].addEventListener('click',function() {
      const tourID =  deleteBtn[i].dataset.id;

      fetch(my_ajax_object.ajax_url, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "itemDelete",
          tourID: tourID,
        }),
      })
        .then((response) => response.text())
        .then((data) => {
          window.location.reload();
        })
        .catch((error) => {
          console.error("Error:", error);
        });

    })

  }
  if(tourTypeFootball) {
    tourTypeFootball.addEventListener('change', function(e) {

		const tourName = e.target.value;
	  
		fetch(my_ajax_object.ajax_url, {
		  method: "POST",
		  headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		  },
		  body: new URLSearchParams({
			action: "previewTourImg",
			tourName: tourName,
		  }),
		})
		  .then((response) => response.text())
		  .then((data) => {
			tourPreview.innerHTML = `<img src=${data} class=' rounded' alt=logo />`;
		  })
		  .catch((error) => {
			console.error("Error:", error);
		  });
	  });
  }

    

if(tourTypeBasketball) {
    tourTypeBasketball.addEventListener('change', function(e) {

		const tourName = e.target.value;
	  
		fetch(my_ajax_object.ajax_url, {
		  method: "POST",
		  headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		  },
		  body: new URLSearchParams({
			action: "previewTourImg",
			tourName: tourName,
		  }),
		})
		  .then((response) => response.text())
		  .then((data) => {
			tourPreview.inner = `<img src='${data}' alt=logo '/>`;
		  })
		  .catch((error) => {
			console.error("Error:", error);
		  });
	  });
}
    





};
export default ajaxCall;
