const loadSettingFields = () => {

  const sportType            = document.getElementById("tourSport");
  const tourTypeWrap         = document.getElementById("tourTypeWrap");
  const tourTypeFootball     = document.querySelector('#tourType_football');
  const tourTypeBasketball   = document.querySelector('#tourType_basketball');

  if (!sportType) return;

  sportType.addEventListener("change", function (e) {
    let sportValue = e.target.value;

    if (sportValue === "football") 
    {
      tourTypeWrap.style='display:block!important';
      tourTypeFootball.style='display:block !important';
      tourTypeBasketball.style='display:none !important';

    } 
      else if (sportValue === "basketball") 
    {

      tourTypeWrap.style='display:block!important';
      tourTypeBasketball.style='display:block !important';;
      tourTypeFootball.style='display:none !important';
    }
  });
};

export default loadSettingFields;
